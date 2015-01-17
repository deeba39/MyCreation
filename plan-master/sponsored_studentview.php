<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "sponsored_studentinfo.php" ?>
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
$sponsored_student_view = new csponsored_student_view();
$Page =& $sponsored_student_view;

// Page init
$sponsored_student_view->Page_Init();

// Page main
$sponsored_student_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($sponsored_student->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var sponsored_student_view = new ew_Page("sponsored_student_view");

// page properties
sponsored_student_view.PageID = "view"; // page ID
sponsored_student_view.FormID = "fsponsored_studentview"; // form ID
var EW_PAGE_ID = sponsored_student_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
sponsored_student_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
sponsored_student_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sponsored_student_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $sponsored_student->TableCaption() ?>
<br><br>
<?php if ($sponsored_student->Export == "") { ?>
<a href="<?php echo $sponsored_student_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanEdit()) { ?>
<?php if ($sponsored_student_view->ShowOptionLink()) { ?>
<a href="<?php echo $sponsored_student_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php if ($Security->AllowList('school_attendance')) { ?>
<?php if ($sponsored_student_view->ShowOptionLink()) { ?>
<a href="school_attendancelist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=sponsored_student&sponsored_student_id=<?php echo urlencode(strval($sponsored_student->sponsored_student_id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("school_attendance", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
<?php if ($Security->AllowList('scholarship_package')) { ?>
<?php if ($sponsored_student_view->ShowOptionLink()) { ?>
<a href="scholarship_packagelist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=sponsored_student&sponsored_student_id=<?php echo urlencode(strval($sponsored_student->sponsored_student_id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("scholarship_package", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>

<a href="sponsored_student_detailview.php?sponsored_student_id=<?php echo urlencode(strval($sponsored_student->sponsored_student_id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?>Detail
</a>
&nbsp;

<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$sponsored_student_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($sponsored_student->sponsored_student_id->Visible) { // sponsored_student_id ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->sponsored_student_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student->sponsored_student_id->CellAttributes() ?>>
<div<?php echo $sponsored_student->sponsored_student_id->ViewAttributes() ?>><?php echo $sponsored_student->sponsored_student_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->student_firstname->Visible) { // student_firstname ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_firstname->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_firstname->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_firstname->ViewAttributes() ?>><?php echo $sponsored_student->student_firstname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->student_middlename->Visible) { // student_middlename ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_middlename->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_middlename->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_middlename->ViewAttributes() ?>><?php echo $sponsored_student->student_middlename->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->student_lastname->Visible) { // student_lastname ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_lastname->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_lastname->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_lastname->ViewAttributes() ?>><?php echo $sponsored_student->student_lastname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->student_applicant_student_applicant_id->Visible) { // student_applicant_student_applicant_id ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_applicant_student_applicant_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_applicant_student_applicant_id->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_applicant_student_applicant_id->ViewAttributes() ?>><?php echo $sponsored_student->student_applicant_student_applicant_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_resident_programarea_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_resident_programarea_id->CellAttributes() ?>>
<div<?php echo $sponsored_student->student_resident_programarea_id->ViewAttributes() ?>><?php echo $sponsored_student->student_resident_programarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->group_id->Visible) { // group_id ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->group_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student->group_id->CellAttributes() ?>>
<div<?php echo $sponsored_student->group_id->ViewAttributes() ?>><?php echo $sponsored_student->group_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($sponsored_student->community_community_id->Visible) { // community_community_id ?>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->community_community_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student->community_community_id->CellAttributes() ?>>
<div<?php echo $sponsored_student->community_community_id->ViewAttributes() ?>><?php echo $sponsored_student->community_community_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($sponsored_student->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$sponsored_student_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csponsored_student_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'sponsored_student';

	// Page object name
	var $PageObjName = 'sponsored_student_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $sponsored_student;
		if ($sponsored_student->UseTokenInUrl) $PageUrl .= "t=" . $sponsored_student->TableVar . "&"; // Add page token
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
		global $objForm, $sponsored_student;
		if ($sponsored_student->UseTokenInUrl) {
			if ($objForm)
				return ($sponsored_student->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($sponsored_student->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csponsored_student_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (sponsored_student)
		$GLOBALS["sponsored_student"] = new csponsored_student();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sponsored_student', TRUE);

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
		global $sponsored_student;

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
			$this->Page_Terminate("sponsored_studentlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("sponsored_studentlist.php");
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
		global $Language, $sponsored_student;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["sponsored_student_id"] <> "") {
				$sponsored_student->sponsored_student_id->setQueryStringValue($_GET["sponsored_student_id"]);
				$this->arRecKey["sponsored_student_id"] = $sponsored_student->sponsored_student_id->QueryStringValue;
			} else {
				$sReturnUrl = "sponsored_studentlist.php"; // Return to list
			}

			// Get action
			$sponsored_student->CurrentAction = "I"; // Display form
			switch ($sponsored_student->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "sponsored_studentlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "sponsored_studentlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$sponsored_student->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $sponsored_student;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$sponsored_student->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$sponsored_student->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $sponsored_student->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$sponsored_student->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$sponsored_student->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$sponsored_student->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $sponsored_student;
		$sFilter = $sponsored_student->KeyFilter();

		// Call Row Selecting event
		$sponsored_student->Row_Selecting($sFilter);

		// Load SQL based on filter
		$sponsored_student->CurrentFilter = $sFilter;
		$sSql = $sponsored_student->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$sponsored_student->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $sponsored_student;
		$sponsored_student->sponsored_student_id->setDbValue($rs->fields('sponsored_student_id'));
		$sponsored_student->student_firstname->setDbValue($rs->fields('student_firstname'));
		$sponsored_student->student_middlename->setDbValue($rs->fields('student_middlename'));
		$sponsored_student->student_lastname->setDbValue($rs->fields('student_lastname'));
		$sponsored_student->student_picture->Upload->DbValue = $rs->fields('student_picture');
		$sponsored_student->student_grades->setDbValue($rs->fields('student_grades'));
		$sponsored_student->student_applicant_student_applicant_id->setDbValue($rs->fields('student_applicant_student_applicant_id'));
		$sponsored_student->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$sponsored_student->group_id->setDbValue($rs->fields('group_id'));
		$sponsored_student->community_community_id->setDbValue($rs->fields('community_community_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $sponsored_student;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "sponsored_student_id=" . urlencode($sponsored_student->sponsored_student_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "sponsored_student_id=" . urlencode($sponsored_student->sponsored_student_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "sponsored_student_id=" . urlencode($sponsored_student->sponsored_student_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "sponsored_student_id=" . urlencode($sponsored_student->sponsored_student_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "sponsored_student_id=" . urlencode($sponsored_student->sponsored_student_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "sponsored_student_id=" . urlencode($sponsored_student->sponsored_student_id->CurrentValue);
		$this->AddUrl = $sponsored_student->AddUrl();
		$this->EditUrl = $sponsored_student->EditUrl();
		$this->CopyUrl = $sponsored_student->CopyUrl();
		$this->DeleteUrl = $sponsored_student->DeleteUrl();
		$this->ListUrl = $sponsored_student->ListUrl();

		// Call Row_Rendering event
		$sponsored_student->Row_Rendering();

		// Common render codes for all row types
		// sponsored_student_id

		$sponsored_student->sponsored_student_id->CellCssStyle = ""; $sponsored_student->sponsored_student_id->CellCssClass = "";
		$sponsored_student->sponsored_student_id->CellAttrs = array(); $sponsored_student->sponsored_student_id->ViewAttrs = array(); $sponsored_student->sponsored_student_id->EditAttrs = array();

		// student_firstname
		$sponsored_student->student_firstname->CellCssStyle = ""; $sponsored_student->student_firstname->CellCssClass = "";
		$sponsored_student->student_firstname->CellAttrs = array(); $sponsored_student->student_firstname->ViewAttrs = array(); $sponsored_student->student_firstname->EditAttrs = array();

		// student_middlename
		$sponsored_student->student_middlename->CellCssStyle = ""; $sponsored_student->student_middlename->CellCssClass = "";
		$sponsored_student->student_middlename->CellAttrs = array(); $sponsored_student->student_middlename->ViewAttrs = array(); $sponsored_student->student_middlename->EditAttrs = array();

		// student_lastname
		$sponsored_student->student_lastname->CellCssStyle = ""; $sponsored_student->student_lastname->CellCssClass = "";
		$sponsored_student->student_lastname->CellAttrs = array(); $sponsored_student->student_lastname->ViewAttrs = array(); $sponsored_student->student_lastname->EditAttrs = array();

		// student_applicant_student_applicant_id
		$sponsored_student->student_applicant_student_applicant_id->CellCssStyle = ""; $sponsored_student->student_applicant_student_applicant_id->CellCssClass = "";
		$sponsored_student->student_applicant_student_applicant_id->CellAttrs = array(); $sponsored_student->student_applicant_student_applicant_id->ViewAttrs = array(); $sponsored_student->student_applicant_student_applicant_id->EditAttrs = array();

		// student_resident_programarea_id
		$sponsored_student->student_resident_programarea_id->CellCssStyle = ""; $sponsored_student->student_resident_programarea_id->CellCssClass = "";
		$sponsored_student->student_resident_programarea_id->CellAttrs = array(); $sponsored_student->student_resident_programarea_id->ViewAttrs = array(); $sponsored_student->student_resident_programarea_id->EditAttrs = array();

		// group_id
		$sponsored_student->group_id->CellCssStyle = ""; $sponsored_student->group_id->CellCssClass = "";
		$sponsored_student->group_id->CellAttrs = array(); $sponsored_student->group_id->ViewAttrs = array(); $sponsored_student->group_id->EditAttrs = array();

		// community_community_id
		$sponsored_student->community_community_id->CellCssStyle = ""; $sponsored_student->community_community_id->CellCssClass = "";
		$sponsored_student->community_community_id->CellAttrs = array(); $sponsored_student->community_community_id->ViewAttrs = array(); $sponsored_student->community_community_id->EditAttrs = array();
		if ($sponsored_student->RowType == EW_ROWTYPE_VIEW) { // View row

			// sponsored_student_id
			$sponsored_student->sponsored_student_id->ViewValue = $sponsored_student->sponsored_student_id->CurrentValue;
			$sponsored_student->sponsored_student_id->CssStyle = "";
			$sponsored_student->sponsored_student_id->CssClass = "";
			$sponsored_student->sponsored_student_id->ViewCustomAttributes = "";

			// student_firstname
			$sponsored_student->student_firstname->ViewValue = $sponsored_student->student_firstname->CurrentValue;
			$sponsored_student->student_firstname->CssStyle = "";
			$sponsored_student->student_firstname->CssClass = "";
			$sponsored_student->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$sponsored_student->student_middlename->ViewValue = $sponsored_student->student_middlename->CurrentValue;
			$sponsored_student->student_middlename->CssStyle = "";
			$sponsored_student->student_middlename->CssClass = "";
			$sponsored_student->student_middlename->ViewCustomAttributes = "";

			// student_lastname
			$sponsored_student->student_lastname->ViewValue = $sponsored_student->student_lastname->CurrentValue;
			$sponsored_student->student_lastname->CssStyle = "";
			$sponsored_student->student_lastname->CssClass = "";
			$sponsored_student->student_lastname->ViewCustomAttributes = "";

			// student_applicant_student_applicant_id
			$sponsored_student->student_applicant_student_applicant_id->ViewValue = $sponsored_student->student_applicant_student_applicant_id->CurrentValue;
			if (strval($sponsored_student->student_applicant_student_applicant_id->CurrentValue) <> "") {
				$sFilterWrk = "`student_applicant_id` = " . ew_AdjustSql($sponsored_student->student_applicant_student_applicant_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `student_lastname`, `student_firstname` FROM `student_applicant`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sponsored_student->student_applicant_student_applicant_id->ViewValue = $rswrk->fields('student_lastname');
					$sponsored_student->student_applicant_student_applicant_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('student_firstname');
					$rswrk->Close();
				} else {
					$sponsored_student->student_applicant_student_applicant_id->ViewValue = $sponsored_student->student_applicant_student_applicant_id->CurrentValue;
				}
			} else {
				$sponsored_student->student_applicant_student_applicant_id->ViewValue = NULL;
			}
			$sponsored_student->student_applicant_student_applicant_id->CssStyle = "";
			$sponsored_student->student_applicant_student_applicant_id->CssClass = "";
			$sponsored_student->student_applicant_student_applicant_id->ViewCustomAttributes = "";

			// student_resident_programarea_id
			if (strval($sponsored_student->student_resident_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($sponsored_student->student_resident_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sponsored_student->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$sponsored_student->student_resident_programarea_id->ViewValue = $sponsored_student->student_resident_programarea_id->CurrentValue;
				}
			} else {
				$sponsored_student->student_resident_programarea_id->ViewValue = NULL;
			}
			$sponsored_student->student_resident_programarea_id->CssStyle = "";
			$sponsored_student->student_resident_programarea_id->CssClass = "";
			$sponsored_student->student_resident_programarea_id->ViewCustomAttributes = "";

			// group_id
			$sponsored_student->group_id->ViewValue = $sponsored_student->group_id->CurrentValue;
			$sponsored_student->group_id->CssStyle = "";
			$sponsored_student->group_id->CssClass = "";
			$sponsored_student->group_id->ViewCustomAttributes = "";

			// community_community_id
			$sponsored_student->community_community_id->ViewValue = $sponsored_student->community_community_id->CurrentValue;
			$sponsored_student->community_community_id->CssStyle = "";
			$sponsored_student->community_community_id->CssClass = "";
			$sponsored_student->community_community_id->ViewCustomAttributes = "";

			// sponsored_student_id
			$sponsored_student->sponsored_student_id->HrefValue = "";
			$sponsored_student->sponsored_student_id->TooltipValue = "";

			// student_firstname
			$sponsored_student->student_firstname->HrefValue = "";
			$sponsored_student->student_firstname->TooltipValue = "";

			// student_middlename
			$sponsored_student->student_middlename->HrefValue = "";
			$sponsored_student->student_middlename->TooltipValue = "";

			// student_lastname
			$sponsored_student->student_lastname->HrefValue = "";
			$sponsored_student->student_lastname->TooltipValue = "";

			// student_applicant_student_applicant_id
			$sponsored_student->student_applicant_student_applicant_id->HrefValue = "";
			$sponsored_student->student_applicant_student_applicant_id->TooltipValue = "";

			// student_resident_programarea_id
			$sponsored_student->student_resident_programarea_id->HrefValue = "";
			$sponsored_student->student_resident_programarea_id->TooltipValue = "";

			// group_id
			$sponsored_student->group_id->HrefValue = "";
			$sponsored_student->group_id->TooltipValue = "";

			// community_community_id
			$sponsored_student->community_community_id->HrefValue = "";
			$sponsored_student->community_community_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($sponsored_student->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$sponsored_student->Row_Rendered();
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $sponsored_student;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($sponsored_student->group_id->CurrentValue);
			}
		}
		return TRUE;
	}

		// Page Load event
function Page_Load() {
    //echo "Page Load";
     $_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];
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
