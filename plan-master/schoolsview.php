<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "schoolsinfo.php" ?>
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
$schools_view = new cschools_view();
$Page =& $schools_view;

// Page init
$schools_view->Page_Init();

// Page main
$schools_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($schools->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var schools_view = new ew_Page("schools_view");

// page properties
schools_view.PageID = "view"; // page ID
schools_view.FormID = "fschoolsview"; // form ID
var EW_PAGE_ID = schools_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
schools_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
schools_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
schools_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $schools->TableCaption() ?>
<br><br>
<?php if ($schools->Export == "") { ?>
<a href="<?php echo $schools_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $schools_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $schools_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $schools_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('view_sponsored_student_school')) { ?>
<a href="view_sponsored_student_schoollist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=schools&school_id=<?php echo urlencode(strval($schools->school_id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("view_sponsored_student_school", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$schools_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($schools->school_id->Visible) { // school_id ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->school_id->FldCaption() ?></td>
		<td<?php echo $schools->school_id->CellAttributes() ?>>
<div<?php echo $schools->school_id->ViewAttributes() ?>><?php echo $schools->school_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($schools->school_name->Visible) { // school_name ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->school_name->FldCaption() ?></td>
		<td<?php echo $schools->school_name->CellAttributes() ?>>
<div<?php echo $schools->school_name->ViewAttributes() ?>><?php echo $schools->school_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($schools->address->Visible) { // address ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->address->FldCaption() ?></td>
		<td<?php echo $schools->address->CellAttributes() ?>>
<div<?php echo $schools->address->ViewAttributes() ?>><?php echo $schools->address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($schools->towncity->Visible) { // towncity ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->towncity->FldCaption() ?></td>
		<td<?php echo $schools->towncity->CellAttributes() ?>>
<div<?php echo $schools->towncity->ViewAttributes() ?>><?php echo $schools->towncity->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($schools->school_type->Visible) { // school_type ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->school_type->FldCaption() ?></td>
		<td<?php echo $schools->school_type->CellAttributes() ?>>
<div<?php echo $schools->school_type->ViewAttributes() ?>><?php echo $schools->school_type->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($schools->contact_person_name->Visible) { // contact_person_name ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->contact_person_name->FldCaption() ?></td>
		<td<?php echo $schools->contact_person_name->CellAttributes() ?>>
<div<?php echo $schools->contact_person_name->ViewAttributes() ?>><?php echo $schools->contact_person_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($schools->telephone->Visible) { // telephone ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->telephone->FldCaption() ?></td>
		<td<?php echo $schools->telephone->CellAttributes() ?>>
<div<?php echo $schools->telephone->ViewAttributes() ?>><?php echo $schools->telephone->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($schools->bankname->Visible) { // bankname ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->bankname->FldCaption() ?></td>
		<td<?php echo $schools->bankname->CellAttributes() ?>>
<div<?php echo $schools->bankname->ViewAttributes() ?>><?php echo $schools->bankname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($schools->account_no->Visible) { // account_no ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->account_no->FldCaption() ?></td>
		<td<?php echo $schools->account_no->CellAttributes() ?>>
<div<?php echo $schools->account_no->ViewAttributes() ?>><?php echo $schools->account_no->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($schools->programarea_programarea_id->Visible) { // programarea_programarea_id ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->programarea_programarea_id->FldCaption() ?></td>
		<td<?php echo $schools->programarea_programarea_id->CellAttributes() ?>>
<div<?php echo $schools->programarea_programarea_id->ViewAttributes() ?>><?php echo $schools->programarea_programarea_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($schools->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$schools_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cschools_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'schools';

	// Page object name
	var $PageObjName = 'schools_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $schools;
		if ($schools->UseTokenInUrl) $PageUrl .= "t=" . $schools->TableVar . "&"; // Add page token
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
		global $objForm, $schools;
		if ($schools->UseTokenInUrl) {
			if ($objForm)
				return ($schools->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($schools->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cschools_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (schools)
		$GLOBALS["schools"] = new cschools();

		// Table object (programarea)
		$GLOBALS['programarea'] = new cprogramarea();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'schools', TRUE);

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
		global $schools;

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
			$this->Page_Terminate("schoolslist.php");
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
		global $Language, $schools;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["school_id"] <> "") {
				$schools->school_id->setQueryStringValue($_GET["school_id"]);
				$this->arRecKey["school_id"] = $schools->school_id->QueryStringValue;
			} else {
				$sReturnUrl = "schoolslist.php"; // Return to list
			}

			// Get action
			$schools->CurrentAction = "I"; // Display form
			switch ($schools->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "schoolslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "schoolslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$schools->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $schools;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$schools->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$schools->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $schools->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$schools->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$schools->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$schools->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $schools;
		$sFilter = $schools->KeyFilter();

		// Call Row Selecting event
		$schools->Row_Selecting($sFilter);

		// Load SQL based on filter
		$schools->CurrentFilter = $sFilter;
		$sSql = $schools->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$schools->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $schools;
		$schools->school_id->setDbValue($rs->fields('school_id'));
		$schools->school_name->setDbValue($rs->fields('school_name'));
		$schools->address->setDbValue($rs->fields('address'));
		$schools->towncity->setDbValue($rs->fields('towncity'));
		$schools->school_type->setDbValue($rs->fields('school_type'));
		$schools->contact_person_name->setDbValue($rs->fields('contact_person_name'));
		$schools->telephone->setDbValue($rs->fields('telephone'));
		$schools->bankname->setDbValue($rs->fields('bankname'));
		$schools->account_no->setDbValue($rs->fields('account_no'));
		$schools->programarea_programarea_id->setDbValue($rs->fields('programarea_programarea_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $schools;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "school_id=" . urlencode($schools->school_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "school_id=" . urlencode($schools->school_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "school_id=" . urlencode($schools->school_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "school_id=" . urlencode($schools->school_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "school_id=" . urlencode($schools->school_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "school_id=" . urlencode($schools->school_id->CurrentValue);
		$this->AddUrl = $schools->AddUrl();
		$this->EditUrl = $schools->EditUrl();
		$this->CopyUrl = $schools->CopyUrl();
		$this->DeleteUrl = $schools->DeleteUrl();
		$this->ListUrl = $schools->ListUrl();

		// Call Row_Rendering event
		$schools->Row_Rendering();

		// Common render codes for all row types
		// school_id

		$schools->school_id->CellCssStyle = ""; $schools->school_id->CellCssClass = "";
		$schools->school_id->CellAttrs = array(); $schools->school_id->ViewAttrs = array(); $schools->school_id->EditAttrs = array();

		// school_name
		$schools->school_name->CellCssStyle = ""; $schools->school_name->CellCssClass = "";
		$schools->school_name->CellAttrs = array(); $schools->school_name->ViewAttrs = array(); $schools->school_name->EditAttrs = array();

		// address
		$schools->address->CellCssStyle = ""; $schools->address->CellCssClass = "";
		$schools->address->CellAttrs = array(); $schools->address->ViewAttrs = array(); $schools->address->EditAttrs = array();

		// towncity
		$schools->towncity->CellCssStyle = ""; $schools->towncity->CellCssClass = "";
		$schools->towncity->CellAttrs = array(); $schools->towncity->ViewAttrs = array(); $schools->towncity->EditAttrs = array();

		// school_type
		$schools->school_type->CellCssStyle = ""; $schools->school_type->CellCssClass = "";
		$schools->school_type->CellAttrs = array(); $schools->school_type->ViewAttrs = array(); $schools->school_type->EditAttrs = array();

		// contact_person_name
		$schools->contact_person_name->CellCssStyle = ""; $schools->contact_person_name->CellCssClass = "";
		$schools->contact_person_name->CellAttrs = array(); $schools->contact_person_name->ViewAttrs = array(); $schools->contact_person_name->EditAttrs = array();

		// telephone
		$schools->telephone->CellCssStyle = ""; $schools->telephone->CellCssClass = "";
		$schools->telephone->CellAttrs = array(); $schools->telephone->ViewAttrs = array(); $schools->telephone->EditAttrs = array();

		// bankname
		$schools->bankname->CellCssStyle = ""; $schools->bankname->CellCssClass = "";
		$schools->bankname->CellAttrs = array(); $schools->bankname->ViewAttrs = array(); $schools->bankname->EditAttrs = array();

		// account_no
		$schools->account_no->CellCssStyle = ""; $schools->account_no->CellCssClass = "";
		$schools->account_no->CellAttrs = array(); $schools->account_no->ViewAttrs = array(); $schools->account_no->EditAttrs = array();

		// programarea_programarea_id
		$schools->programarea_programarea_id->CellCssStyle = ""; $schools->programarea_programarea_id->CellCssClass = "";
		$schools->programarea_programarea_id->CellAttrs = array(); $schools->programarea_programarea_id->ViewAttrs = array(); $schools->programarea_programarea_id->EditAttrs = array();
		if ($schools->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_id
			$schools->school_id->ViewValue = $schools->school_id->CurrentValue;
			$schools->school_id->CssStyle = "";
			$schools->school_id->CssClass = "";
			$schools->school_id->ViewCustomAttributes = "";

			// school_name
			$schools->school_name->ViewValue = $schools->school_name->CurrentValue;
			$schools->school_name->CssStyle = "";
			$schools->school_name->CssClass = "";
			$schools->school_name->ViewCustomAttributes = "";

			// address
			$schools->address->ViewValue = $schools->address->CurrentValue;
			$schools->address->CssStyle = "";
			$schools->address->CssClass = "";
			$schools->address->ViewCustomAttributes = "";

			// towncity
			$schools->towncity->ViewValue = $schools->towncity->CurrentValue;
			$schools->towncity->CssStyle = "";
			$schools->towncity->CssClass = "";
			$schools->towncity->ViewCustomAttributes = "";

			// school_type
			if (strval($schools->school_type->CurrentValue) <> "") {
				$sFilterWrk = "`school_type` = '" . ew_AdjustSql($schools->school_type->CurrentValue) . "'";
			$sSqlWrk = "SELECT `school_type` FROM `school_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$schools->school_type->ViewValue = $rswrk->fields('school_type');
					$rswrk->Close();
				} else {
					$schools->school_type->ViewValue = $schools->school_type->CurrentValue;
				}
			} else {
				$schools->school_type->ViewValue = NULL;
			}
			$schools->school_type->CssStyle = "";
			$schools->school_type->CssClass = "";
			$schools->school_type->ViewCustomAttributes = "";

			// contact_person_name
			$schools->contact_person_name->ViewValue = $schools->contact_person_name->CurrentValue;
			$schools->contact_person_name->CssStyle = "";
			$schools->contact_person_name->CssClass = "";
			$schools->contact_person_name->ViewCustomAttributes = "";

			// telephone
			$schools->telephone->ViewValue = $schools->telephone->CurrentValue;
			$schools->telephone->CssStyle = "";
			$schools->telephone->CssClass = "";
			$schools->telephone->ViewCustomAttributes = "";

			// bankname
			$schools->bankname->ViewValue = $schools->bankname->CurrentValue;
			$schools->bankname->CssStyle = "";
			$schools->bankname->CssClass = "";
			$schools->bankname->ViewCustomAttributes = "";

			// account_no
			$schools->account_no->ViewValue = $schools->account_no->CurrentValue;
			$schools->account_no->CssStyle = "";
			$schools->account_no->CssClass = "";
			$schools->account_no->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($schools->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($schools->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$schools->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$schools->programarea_programarea_id->ViewValue = $schools->programarea_programarea_id->CurrentValue;
				}
			} else {
				$schools->programarea_programarea_id->ViewValue = NULL;
			}
			$schools->programarea_programarea_id->CssStyle = "";
			$schools->programarea_programarea_id->CssClass = "";
			$schools->programarea_programarea_id->ViewCustomAttributes = "";

			// school_id
			$schools->school_id->HrefValue = "";
			$schools->school_id->TooltipValue = "";

			// school_name
			$schools->school_name->HrefValue = "";
			$schools->school_name->TooltipValue = "";

			// address
			$schools->address->HrefValue = "";
			$schools->address->TooltipValue = "";

			// towncity
			$schools->towncity->HrefValue = "";
			$schools->towncity->TooltipValue = "";

			// school_type
			$schools->school_type->HrefValue = "";
			$schools->school_type->TooltipValue = "";

			// contact_person_name
			$schools->contact_person_name->HrefValue = "";
			$schools->contact_person_name->TooltipValue = "";

			// telephone
			$schools->telephone->HrefValue = "";
			$schools->telephone->TooltipValue = "";

			// bankname
			$schools->bankname->HrefValue = "";
			$schools->bankname->TooltipValue = "";

			// account_no
			$schools->account_no->HrefValue = "";
			$schools->account_no->TooltipValue = "";

			// programarea_programarea_id
			$schools->programarea_programarea_id->HrefValue = "";
			$schools->programarea_programarea_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($schools->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$schools->Row_Rendered();
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
